import { useState } from "react";
import { API_URL } from "../config";

const Order = ({ order, index }) => {
  const [staff, setStaff] = useState("");
  // const [orders, setOrders] = useState([]);
  // const [loading, setLoading] = useState(true);

  const handleChange = e => {
    setStaff(e.target.value);
  };

  const handleStatus = event => {
    console.log(event);
  };

  const handleUpdateRequest = requestId => {
    if (staff === "") {
      return;
    }

    fetch(`${API_URL}/company/1/service`, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `service_request_id=${requestId}&user_id=${staff}`,
    })
      .then(response => response.json())
      .then(response => {
        if (response === "false") {
          return alert("Staff not available for this day");
        }
        window.location.reload(false);
      });
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
        <div className="font-medium text-gray-900">
          {order.service[0] && order.service[0].name}
        </div>
      </td>
      <td className="px-6 py-4 whitespace-nowrap">
        <select
          defaultValue={order.order[0] && order.order[0].status}
          className="outline-none"
          onChange={handleStatus.bind(this)}
        >
          <option value="pending">{"Pending"}</option>
          <option value="started">{"Started"}</option>
          <option value="finished">{"Finished"}</option>
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
              <option key={index} value={staff.id}>
                {staff.name}
              </option>
            );
          })}
        </select>
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <button
          className="bg-green-400 text-white p-2 rounded-md font-bold hover:bg-green-900"
          onClick={handleUpdateRequest.bind(this, order.id)}
        >
          Submit
        </button>
      </td>
    </tr>
  );
};
export default Order;
