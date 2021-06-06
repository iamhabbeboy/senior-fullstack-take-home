import { Link } from "react-router-dom";

const Header = () => {
  return (
    <div className="bg-blue-500 text-white w-full p-3">
      <div className="w-8/12 mx-auto flex space-between">
        <div className="w-2/12">Logo</div>
        <div className="w-10/12">
          <ul>
            <li className="inline-block px-4 hover:text-gray-900">
              <Link to="/">Home</Link>
            </li>
            <li className="inline-block px-4 hover:text-gray-900">
              <Link to="/staff">Staff</Link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
};
export default Header;
