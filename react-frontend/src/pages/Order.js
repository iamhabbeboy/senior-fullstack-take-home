import OrderListing from "../components/OrderListing";
import Header from "../components/Header";

const Staff = () => {
  return (
    <>
      <Header />
      <div className="w-8/12 mx-auto mt-5">
        <OrderListing />
      </div>
    </>
  );
};
export default Staff;
