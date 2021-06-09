const Order = ({ order, index }) => {
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
        <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-green-800">
          {order.status}
        </span>
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-gray-500">{""}</td>
      <td className="px-6 py-4 whitespace-nowrap text-gray-500">
        {order.proposed_start_date.date}
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-gray-500">
        {" "}
        {order.proposed_end_date.date}
      </td>
      <td className="px-6 py-4 whitespace-nowrap font-medium text-gray-500">
        $1,500
      </td>
      <td className="px-12 py-4 whitespace-nowrap font-medium text-gray-500">
        <select>
          {/* {order.staffs.map((staff, index) => {
            return (
              <option key={index} value={staff.first_name}>
                {staff.first_name}
              </option>
            );
          })} */}
        </select>
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <button className="text-indigo-600 hover:text-indigo-900">
          Delete
        </button>
      </td>
    </tr>
  );
};
export default Order;
