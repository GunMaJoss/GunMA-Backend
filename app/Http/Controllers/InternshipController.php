<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //a
        $internships = Internship::orderBy('id', 'DESC')
            ->with(['user', 'location','tag'])
            ->get();
        // foreach ($internships as $intern) {
        //     $response = [
        //         'message' => 'List data magang order by id',
        //         'programName' => $intern->programName,
        //         'description' => $intern->description,
        //         'benefit' => $intern->benefit,
        //         'requirement' => $intern->requirement,
        //         'registrationLink' => $intern->registrationLink,
        //         'isOpen' => $intern->isOpen,
        //         'duration' => $intern->duration,
        //         'image' => $intern->image->filePath,
        //         'location' => $intern->location->locationName,

        //     ];


        // }
        return response()->json($internships, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request,$userId)
    {
        $user = User::findOrFail($userId);


        $validator = Validator::make($request->all(), [
            'programName' => ['required'],
            'isOpen' => ['required'],
            'description' => ['required'],
            'duration' => ['required', 'numeric'],
            'benefit' => ['required'],
            'requirement' => ['required'],
            'registrationLink' => ['required'],
            'closeRegistration' => ['required'],
            'locationName' => ['required'],
            'tagName' => ['required'],
            'imageUrl' => ['required'],
            'isPaid' => ['required'],
            'isWfh' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $internship = new Internship;
            $internship->programName = $request->programName;
            $internship->isOpen = $request->isOpen;
            $internship->description = $request->description;
            $internship->duration = $request->duration;
            $internship->requirement = $request->requirement;
            $internship->benefit = $request->benefit;
            $internship->registrationLink = $request->registrationLink;
            $internship->closeRegistration = $request->closeRegistration;
            $internship->user_id = $user->id;
            $internship->imageUrl = $request->imageUrl;
            $internship->isWfh = $request->isWfh;
            $internship->isPaid = $request->isPaid;


            $locationController = new LocationController;
            $locationId = $locationController->getLocation($request->locationName);
            $internship->location_id = $locationId;

            $tagController = new TagController;
            $tagId = $tagController->getTag($request->tagName);
            $internship->tag_id = $tagId;
            $internship->save();

            $response = [
                'message' => 'Internship created',
                'data' => $internship
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($internshipId)
    {
        //

        $intern = Internship::findOrFail($internshipId);


        $response = [
            'message' => 'List data magang order by id',
            'programName' => $intern->programName,
            'description' => $intern->description,
            'benefit' => $intern->benefit,
            'requirement' => $intern->requirement,
            'registrationLink' => $intern->registrationLink,
            'isOpen' => $intern->isOpen,
            'duration' => $intern->duration,
            'imageUrl' => $intern->imageUrl,
            'location' => $intern->location->locationName,
            'user' => $intern->user->name,
            'email' => $intern->user->email,
            'phoneNumber' => $intern->user->phoneNumber,
            'isPaid' => $intern->isPaid,
            'isPaid' => $intern->isWfh,



            // 'location' => $intern->location,
            // 'image' => $intern->image,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $internshipId)
    {

        $internship = Internship::findOrFail($internshipId);


        $validator = Validator::make($request->all(), [
            'programName' => ['required'],
            'isOpen' => ['required'],
            'description' => ['required'],
            'duration' => ['required', 'numeric'],
            'benefit' => ['required'],
            'requirement' => ['required'],
            'registrationLink' => ['required'],
            'closeRegistration' => ['required'],
            'locationName' => ['required'],
            'tagName' => ['required'],
            'imageUrl' => ['required'],
            'isPaid' => ['required'],
            'isWfh' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $internship->programName = $request->programName;
            $internship->isOpen = $request->isOpen;
            $internship->description = $request->description;
            $internship->duration = $request->duration;
            $internship->requirement = $request->requirement;
            $internship->benefit = $request->benefit;
            $internship->registrationLink = $request->registrationLink;
            $internship->closeRegistration = $request->closeRegistration;
            $internship->user_id = $internship->id;
            $internship->imageUrl = $request->imageUrl;
            $internship->isWfh = $request->isWfh;
            $internship->isPaid = $request->isPaid;

            $locationController = new LocationController;
            $locationId = $locationController->getLocation($request->locationName);
            $internship->location_id = $locationId;

            $tagController = new TagController;
            $tagId = $tagController->getTag($request->tagName);
            $internship->tag_id = $tagId;
            $internship->save();

            $response = [
                'message' => 'Internship edited',
                'data' => $internship
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($internshipId)
    {
        //
        $internship = Internship::findOrFail($internshipId);

        try {
            $internship->delete();
            $response = [
                'message' => 'Internship deleted',

            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->errorInfo
            ]);
        }
    }
}
