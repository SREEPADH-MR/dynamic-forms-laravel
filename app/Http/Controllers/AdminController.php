<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Form;

class AdminController extends Controller
{
    /**
     * Display the form list view.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function formListTemplate(Request $request)
    {
        $form = Form::latest()->get();

        return view('dashboard')->with('formList', $form);
    }

    /**
     * Display the form create view.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function formCreateTemplate(Request $request)
    {
        return view('formCreate');
    }

    /**
     * Handle an incoming create request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function formCreate(Request $request)
    {
        // check form is valid
        $validator = $this->validateAdminForm($request);
        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        $formData = $request->all();
        if ($request->has('options')) {
            $formData['options'] = implode(',', $formData['options']);
        }

        $formCreateResponse = Form::create($formData);

        if ($formCreateResponse) {
            return to_route('formListTemplate')->with('success', "Form Successfully Created");
        }
    }

    /**
     * Handle an incoming update request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function formUpdate(Request $request, $formId)
    {
        $form = Form::findOrFail($formId);
    
        // check admin form is valid
        $validator = $this->validateAdminForm($request);
        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        $formData = $request->all();

        if ($form) {
            $formUpdateResponse = tap($form)->update($formData);

            if ($formUpdateResponse) {
                return to_route('formListTemplate')->with('success', "Form Successfully Updated");
            }
        }
    }

    /**
     * check form is valid
     *
     * @param $request
     * @return Validator $validator
     */
    public function validateAdminForm($request)
    {
        $data = $request->all();

        $validator = Validator::make(
            $data,
            [
                'label' => 'required|min:2',
                'sample' => 'required',
                'field' => 'required',
                'options' => 'nullable',
                'comments' => 'nullable',
            ],
        );

        return $validator;
    }

    /**
     * Display the form edit view.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $formId
     * @return \Illuminate\View\View
     */
    public function formEditTemplate(Request $request, $formId)
    {
        $formData = Form::findOrFail($formId);

        if ($formData['options'] == null) {
            $formData['options'] = [];
        } else {
            $formData['options'] = explode(',', $formData['options']);
        }

        if ($formData) {
            return view('formEdit')->with('formEdit', $formData);
        }
    }

    /**
     * Handle an incoming delete request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $formId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function formDelete(Request $request, $formId)
    {
        $form = Form::findOrFail($formId);

        if ($form) {
            $formDeleteResponse = tap($form)->delete();

            if ($formDeleteResponse) {
                return to_route('formListTemplate')->with('success', "Form Successfully Deleted");
            }
        }
    }
}
