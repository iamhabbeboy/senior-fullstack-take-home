import { useEffect, useState } from "react";
import { API_URL } from "../config";

const Order = ({ order, index }) => {
  const [staff, setStaff] = useState("");
  // const [orders, setOrders] = useState([]);
  // const [loading, setLoading] = useState(true);

  const handleChange = e => {
    setStaff(e.target.value);
  };

  const handleUpdateRequest = () => {
    if (staff === "") {
      return alert("Please select a staff");
    }

    // useEffect(() => {
    //   fetch(`${API_URL}/company/1/service`)
    //     .then(response => response.json())
    //     .then(response => {
    //       setOrders(JSON.parse(response).data);
    //       setLoading(false);
    //     });
    // }, []);
  };

  return (
    <tr>
      <td className="px-6 py-4 whitespace-nowrap">
        <div>
          <div className="font-medium text-gray-900">{index + 1}</div>
        </div>
      </td>
      <td className="px-6 py-4 whitespace-nowrap">
        <div className="font-medium text-gray-900">{order.title}</div>
      </td>
      <td className="px-6 py-4 whitespace-nowrap">
        <div className="font-medium text-gray-900">{"regular"}</div>
      </td>
      <td className="px-6 py-4 whitespace-nowrap">
        <select defaultValue={"pending"} className="outline-none">
          <option
            value="pending"
            defaultValue={order.status === "pending" ? true : false}
          >
            {"Pending"}
          </option>
          <option
            value="started"
            defaultValue={order.status === "started" ? true : false}
          >
            {"Started"}
          </option>
          <option
            value="finished"
            defaultValue={order.status === "finished" ? true : false}
          >
            {"Finished"}
          </option>
        </select>
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-gray-500">
        {order.rate[0] ? order.rate[0].unit : "0"}
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-gray-500">
        {order.proposed_start_date.date}
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-gray-500">
        {" "}
        {order.proposed_end_date.date}
      </td>
      <td className="px-6 py-4 whitespace-nowrap font-medium text-gray-500">
        ${order.rate[0] ? order.rate[0].amount : 0}
      </td>
      <td className="px-12 py-4 whitespace-nowrap font-medium text-gray-500">
        <select
          defaultValue={"DEFAULT"}
          className="outline-none"
          onChange={handleChange}
        >
          <option value="DEFAULT" disabled>
            Select
          </option>
          {order.staff.map((staff, index) => {
            return (
              <option key={index} value={staff.name}>
                {staff.name}
              </option>
            );
          })}
        </select>
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <button
          className="bg-green-400 text-white p-2 rounded-md font-bold hover:bg-green-900"
          onClick={handleUpdateRequest}
        >
          Submit
        </button>
      </td>
    </tr>
  );
};
export default Order;
