<?php

namespace App\Http\Controllers\Templates;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

use function PHPUnit\Framework\isEmpty;

abstract class BaseCRUDController extends Controller

{
    protected $model;
    protected $viewPath;
    protected $routePath;
    protected $item;
    protected $attributes = [];

    public function index($extraData = null)
    {
        if(!isset($extraData)) {
            $items = $this->model::orderBy('created_at')->paginate(10);

            return view("content.$this->viewPath.index", [
                Str::plural($this->item) => $items
            ]);
        }
        return view("content.".$this->viewPath, [...$extraData]);
    }

    public function create()
    {
        return view('content.'.$this->viewPath . '.create');
    }

    public function store(Request $request, $data = null, Closure $errorHandler = null)
    {
        try {
            $this->validateRequest($request);
            $this->model::create($data ?? $request->all());
            return redirect()->route($this->routePath . '.index')->with('success', ucfirst($this->item).' created successfully.');
        } catch (\Exception $e) {
            return $this->handleException($e, $errorHandler);
        }
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        return view($this->routePath . '.edit', compact($this->item));
    }

    public function update($id, Request $request, $data = null, Closure $errorHandler = null)
    {
        try {
            $requestData = $this->updateValidateRequest($request);

            $item = $this->model::findOrFail($id);

            if(isset($requestData) && !$request->filled('password')) {
                unset($requestData['data']['password']);
            }

            $requestData['request']->validate($requestData['data']);

            $item->update($data ?: $request->all());
            return redirect()->route($this->routePath . '.index')->with('success', ucfirst($this->item).' updated successfully.');
        } catch (\Exception $e) {
            return $this->handleException($e, $errorHandler);
        }
    }

    public function destroy($id, Closure $errorHandler = null)
    {
        try {
            $item = $this->model::findOrFail($id);
            $item->delete();
            return redirect()->route($this->routePath . '.index')->with('success', ucfirst($this->item).' deleted successfully.');
        } catch (\Exception $e) {
            return $this->handleException($e, $errorHandler);
        }
    }

    protected abstract function validateRequest(Request $request, $isDataReturned = false);
    private function updateValidateRequest(Request $request)
    {
        return array(
            "data" => $this->validateRequest($request, true),
            "request" => $request
        );
    }

    protected function handleException(\Exception $e, Closure $errorHandler = null)
    {
        if ($errorHandler) {
            return $errorHandler($e);
        }
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

}
