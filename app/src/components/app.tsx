import { ReactElement } from "react";

import { BillingTable } from "./billing-table";
import { SendFileForm } from "./send-file-form";
import { Toaster } from "./ui";

const App = (): ReactElement => {
  return (
    <div className="bg-zinc-800">
      <Toaster />
      <div className="container mx-auto h-screen w-screen text-white">
        <div className="px-5 pt-6">
          <SendFileForm />
          <BillingTable/>
        </div>
      </div>
    </div>
  );
};

export { App }