<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class UserController extends Controller
{
    /**
     * Display the form list view.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function publicFormListTemplate(Request $request)
    {
        $formData = Form::all();

        $form = [];
        $i = 0;
        foreach ($formData->toArray() as $value) {
            // dump($value['options']);
            if ($value['options'] == null) {
                $value['options'] = ['No options available'];
            } else {
                $value['options'] = explode(',', $value['options']);
            }
            $form[$i] = $value;
            $i++;
        }

        return view('publicForm')->with('formList', $form);
    }
}
