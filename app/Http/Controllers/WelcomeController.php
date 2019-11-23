<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Appeal;
use App\AppealsChange;
use Auth;

class WelcomeController extends Controller
{
    public function show()
    {
    	return view('welcome', ['route' => route('createAppeal')]);
    }

    private function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:100',
            'message' => 'required|string|max:2500|min:5',
        ]);
    }

    private function createAppeal(array $data)
    {
        return Appeal::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message'],
        ]);
    }

    public function create(Request $request)
    {
    	$this->validator($request->all())->validate();
    	$appeal = $this->createAppeal($request->all());
    	session()->flash('created', 'Your message has been sent!!!');
    	return redirect()->route('welcome');
    }

    public function delete($id)
    {
    	Appeal::destroy($id);
    	session()->flash('messageSuccess', 'Your appeal has been deleted!!!');
    	return redirect()->route('home');
    }

    public function update(Request $request, $id)
    {
    	$appeal = Appeal::find($id);
        session()->flash('name', $appeal->name);
        session()->flash('email', $appeal->email);
        session()->flash('phone', $appeal->phone);
        session()->flash('message', $appeal->message);
    	return view('welcome', ['route' => route('updateAppeal', [$id])]);
    }

    public function saveUpdate(Request $request, $id)
    {
    	$this->validator($request->all())->validate();
    	$appeal = $this->updateAppeal($request->all(), $id);
    	session()->flash('messageSuccess', 'Your message has been updated!!!');
    	return redirect()->route('home');
    }

    private function updateAppeal($data, $id)
    {
    	$appeal = Appeal::find($id);

		$appeal->name = $data['name'];
		$appeal->email = $data['email'];
		$appeal->phone = $data['phone'];
		$appeal->message = $data['message'];
		$appeal->status = 'Read!';

		$appeal->save();

		AppealsChange::create([
			'user_id' => Auth::id(),
			'appeal_id' => $id
		]);
    }

    public function changeStatus($id)
    {
    	$appeal = Appeal::find($id);
    	if ($appeal->status == 'Unread!') {
    		$appeal->status = 'Read!';
    	} else {
    		$appeal->status = 'Unread!';
    	}
    	$appeal->save();
    	session()->flash('messageSuccess', 'Appeal\'s status has been changed!!!');
    	return redirect()->route('home');
    }

    public function showHistory($id)
    {
    	$appealsChanges = Appeal::find($id)->appeals_changes;
    	return view('history', ['appealsChanges' => $appealsChanges, 'id' => $id]);
    }
}
