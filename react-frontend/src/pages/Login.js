const Login = () => {
  return (
    <div className="w-full h-screen pt-10">
      <div className="mx-auto w-3/12 bg-white rounded-lg px-5 py-8 mt-10">
        <h1 className="text-lg pb-3 text-blue-600 font-bold">Login</h1>
        <label className="text-gray-500">Email Address</label>
        <input
          type="email"
          className="rounded-md border border-gray-200 block w-full p-3 mb-3 outline-none focus:border-blue-400"
        />
        <label className="text-gray-500">Password</label>
        <input
          type="password"
          className="rounded-md border border-gray-200 block w-full p-3 outline-none focus:border-blue-400"
        />
        <button className="bg-blue-400 px-8 text-white py-3 rounded-md mt-4 hover:bg-blue-300">
          Login
        </button>
      </div>
    </div>
  );
};
export default Login;
