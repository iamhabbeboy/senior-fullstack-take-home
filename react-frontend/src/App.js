import Login from "./pages/Login";
import Order from "./pages/Order";
import "./App.css";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";

function App() {
  return (
    <div className=" bg-gray-200 h-screen">
      <Router>
        <Switch>
          <Route path="/order">
            <Order />
          </Route>
          <Route path="/">
            <Login />
          </Route>
        </Switch>
      </Router>
    </div>
  );
}

export default App;
