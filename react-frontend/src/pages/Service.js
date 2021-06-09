import ListOrder from "../components/ListOrder";
import Header from "../components/Header";
import { useEffect, useState } from "react";

const Service = () => {
  const orders = [
    {
      id: 1,
      company: "Bashlabs Innovation",
      service: "Spring/Deep Cleaning",
      unit: "sqft",
      total: "3000",
      created_at: "",
      staffs: [
        {
          first_name: "John",
          last_name: "Doe",
          hourly_rate: 100,
          avaialability: true,
        },
      ],
    },
    {
      id: 2,
      company: "Innovation Creed",
      service: "Regular",
      unit: "sqft",
      total: "3000",
      created_at: "",
      staffs: [
        {
          first_name: "Joh",
          last_name: "Doe",
          hourly_rate: 100,
          avaialability: true,
        },
      ],
    },
  ];
  const [orders1, setOrders1] = useState([]);
  useEffect(() => {
    let mounted = true;
    fetch("http://localhost:5000/order")
      .then(data => data.json())
      .then(data => {
        if (mounted) {
          setOrders1(data);
        }
      });
    return () => (mounted = false);
  }, []);
  console.log(orders1);
  return (
    <>
      <Header />
      <div className="w-8/12 mx-auto mt-5">
        <ListOrder orders={orders} />
      </div>
    </>
  );
};
export default Service;
