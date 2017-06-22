<?php
//
//    namespace App\Http\Controllers\Api\V1;
//
//    use Illuminate\Http\Request;
//
//    use App\Http\Requests;
//    use App\Http\Controllers\Controller;
//
//    class RouteController extends Controller
//    {
//        /**
//         * Display a listing of the resource.
//         *
//         * @return \Illuminate\Http\Response
//         */
//        public function index()
//        {
//            $apiRoutes = [];
//            $versions = \DingoRoute::getRoutes();
//            foreach ($versions as $version) {
//                $routes = $version->getRoutes();
//                foreach ($routes as $route) {
//                    $name = (null != $route->getName() ? $route->getName() : $route->getActionName());
//                    $apiRoutes[ $route->uri() ] = $name;
//                }
//            }
//
//            return $apiRoutes;
//        }
//
//        /**
//         * Show the form for creating a new resource.
//         *
//         * @return \Illuminate\Http\Response
//         */
//        public function create()
//        {
//            //
//        }
//
//        /**
//         * Store a newly created resource in storage.
//         *
//         * @param  \Illuminate\Http\Request $request
//         *
//         * @return \Illuminate\Http\Response
//         */
//        public function store(Request $request)
//        {
//            //
//        }
//
//        /**
//         * Display the specified resource.
//         *
//         * @param  int $id
//         *
//         * @return \Illuminate\Http\Response
//         */
//        public function show($id)
//        {
//            //
//        }
//
//        /**
//         * Show the form for editing the specified resource.
//         *
//         * @param  int $id
//         *
//         * @return \Illuminate\Http\Response
//         */
//        public function edit($id)
//        {
//            //
//        }
//
//        /**
//         * Update the specified resource in storage.
//         *
//         * @param  \Illuminate\Http\Request $request
//         * @param  int                      $id
//         *
//         * @return \Illuminate\Http\Response
//         */
//        public function update(Request $request, $id)
//        {
//            //
//        }
//
//        /**
//         * Remove the specified resource from storage.
//         *
//         * @param  int $id
//         *
//         * @return \Illuminate\Http\Response
//         */
//        public function destroy($id)
//        {
//            //
//        }
//    }
