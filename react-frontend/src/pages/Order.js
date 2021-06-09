import ListOrder from "../components/ListOrder";
import Header from "../components/Header";
import { API_URL } from "../config";
import { useEffect, useState } from "react";

const Service = () => {
  const [orders, setOrders] = useState([]);
  const [loading, setLoading] = useState(true);
  useEffect(() => {
    fetch(`${API_URL}/company/1`)
      .then(response => response.json())
      .then(response => {
        setOrders(JSON.parse(response).data);
        setLoading(false);
      });
  }, []);
  return (
    <>
      <Header />
      <div className="w-8/12 mx-auto mt-5">
        {loading ? "please wait..." : <ListOrder orders={orders} />}
      </div>
    </>
  );
};
export default Service;
