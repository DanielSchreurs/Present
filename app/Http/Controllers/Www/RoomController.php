<?php

    namespace App\Http\Controllers\Www;

    use App\Cour;
    use App\Room;
    use App\School;
    use App\User;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Redirect;
    use Laracasts\Flash\Flash;

    class RoomController extends Controller
    {
        /**
         * Instantiate a new RoomController instance.
         */
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('rooms.index')->with('schools', \Auth::user()->schools);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $schools = \Auth::user()->schools->lists('name', 'id');

            return view('rooms.create')->with(compact('schools'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Requests\StoreRoomsRequest $request)
        {
            $room = new Cour($request->all());
            Flash::success('Le local' . $room->name . ' a été créé avec succès.');

            return redirect()->action('Www\SchoolController@getConfig');
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($school_slug, $room_slug)
        {
            $room = School::findBySlugOrFail($school_slug)->rooms()->where('slug', '=', $room_slug)->firstOrfail();

            return view('rooms.room')->with(compact('room'));

        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    }
