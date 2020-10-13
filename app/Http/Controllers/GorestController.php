<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\User;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;


class GorestController extends Controller
{
	public function index()
	{   
		$client = new Client(['base_uri' => 'https://gorest.co.in/public-api/']);
		$response = $client->request('GET', 'users');
		$body = $response->getBody()->getContents();
		$data = json_decode($body, true);
		$finaldata = $data['data'];

        // echo '<pre>' , var_dump($finaldata[0]['name']) , '</pre>';die;

		return view('gorest.index',compact('finaldata'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('gorest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$request->validate([
    		'name'=>'required',
    		'email'=> 'required',
    		'gender' => 'required',
    		'status' => 'required',
        // 'role' => 'required'
    	]);

    	$token = 'c45ee81606b44da6bcb67057df955e941feb97e1be82e94443b1add8499c847d';
    	$client = new Client();
    	$response = $client->request('POST', 'https://gorest.co.in/public-api/users/', 
    		[
    			'headers' => [
    				'Accept' => 'application/json',
    				'Authorization' => 'Bearer ' . $token,
    			],
    			'form_params' => [
    				'name' => $request->name,
    				'email' => $request->email,
    				'gender' => $request->gender,
    				'status' => 'active'
    			]
    		]);
  


      // echo $response->getBody()->getContents();die;

    	return redirect('/gorest');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

    	
    	$client = new Client(['base_uri' => 'https://gorest.co.in/public-api/']);
    	$response = $client->request('GET', 'users/'.$id.'');
    	$body = $response->getBody()->getContents();
    	$data = json_decode($body, true);
    	$finaldata = $data['data'];
        //var_dump($finaldata);die;

    	return view('gorest.show',compact('finaldata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$client = new Client(['base_uri' => 'https://gorest.co.in/public-api/']);
    	$response = $client->request('GET', 'users/'.$id.'');
    	$body = $response->getBody()->getContents();
    	$data = json_decode($body, true);
    	$finaldata = $data['data'];
        //var_dump($finaldata);die;

    	return view('gorest.edit',compact('finaldata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    	$request->validate([
    		'name' => 'required',
    		'email' => 'required',
    		'gender' => 'required',
    		'status' => 'required',
    	]);
    	$token = 'c45ee81606b44da6bcb67057df955e941feb97e1be82e94443b1add8499c847d';
    	$client = new Client();
    	$response = $client->request('PUT', 'https://gorest.co.in/public-api/users/'.$request->id.'', [
    		'headers' => [
    			'Accept' => 'application/json',
    			'Authorization' => 'Bearer ' . $token,
    		],
    		'form_params' => [
    			'name' => $request->name,
    			'email' => $request->email,
    		]
    	]);

      // echo $response->getBody()->getContents();die;

    	return redirect('/gorest');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$token = 'c45ee81606b44da6bcb67057df955e941feb97e1be82e94443b1add8499c847d';
    	$client = new Client();
    	$response = $client->request('DELETE', 'https://gorest.co.in/public-api/users/'.$id.'', [
    		'headers' => [
    			'Accept' => 'application/json',
    			'Authorization' => 'Bearer ' . $token,
    		]
    	]);

      // toastr()->success('User has been deleted successfully!');
    	return redirect('/gorest');
    }
}
