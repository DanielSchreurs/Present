<?php
//
//    namespace App\Http\Controllers\Api\V1;
//
//    use app\Transformers\UserTransformer;
//    use App\User;
//    use Dingo\Api\Auth\Auth;
//    use Dingo\Api\Routing\Helpers;
//    use Dingo\Api\Tests\Stubs\UserTransformerStub;
//    use Illuminate\Http\Request;
//    use Dingo\Api\Exception\ValidationHttpException;
//
//    use App\Http\Requests;
//    use App\Http\Controllers\Controller;
//
//    class UserController extends Controller
//    {
//        use Helpers;
//
//        /**
//         * Display a listing of the resource.
//         *
//         * @return \Illuminate\Http\Response
//         */
//        public function index()
//        {
//            return $this->response->paginator(User::paginate(10), new UserTransformer());
//        }
//
//        public function store()
//        {
//            $rules = [
//                'name'     => 'required|max:255',
//                'email'    => 'required|email|max:255|unique:users',
//                'avatar'   => 'url',
//                'password' => 'required|min:2'
//            ];
//            $payload = app('request')->only('name', 'email', 'avatar', 'password');
//            $validator = app('validator')->make($payload, $rules);
//            if ($validator->fails()) {
//                throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.', $validator->errors());
//            }
//
//            return $this->response->item(app('App\Http\Controllers\Auth\AuthController')->create($payload), new UserTransformer());
//        }
//
//        /**
//         * Display the specified resource.
//         *
//         * @param  string $slug
//         *
//         * @return \Illuminate\Http\Response
//         */
//        public function show($slug)
//        {
//            return $this->response->item(User::findBySlugOrIdOrFail($slug), new UserTransformer());
//        }
//
//        public function update($id)
//        {
//            $user = User::find($id);
//
//            $rules = [
//                'name'   => 'required|string|max:250|min:2',
//                'email'  => 'required|e-mail|unique:users,email,' . $id,
//                'avatar' => 'mimes:jpeg,png|image_size:100-1000'
//            ];
//            $payload = app('request')->only('name', 'email', 'avatar', 'password');
//            $validator = app('validator')->make($payload, $rules);
//            if ($validator->fails()) {
//                throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not update user.', $validator->errors());
//            }
//            $user->update($payload);
//
//            return $this->response->item($user, new UserTransformer());
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
//            $student = User::findBySlugOrIdOrFail($id)->delete();
//            return $this->response->array(['success' => true, 'message' => 'User delete.']);
//        }
//    }
