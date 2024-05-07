/* eslint-disable @typescript-eslint/no-empty-function */
import { fetchBillings } from "@/services/api";
import { Billing } from "@/services/types";
import { ReactNode, createContext, useState } from "react";

interface IBillingContext {
  billings: Billing[];
  addCreatedBillingToList: (billing: Billing) => void,
  getBillings: () => void,
}

export const ListBillingContext = createContext<IBillingContext>({
  billings: [],
  addCreatedBillingToList: () => {},
  getBillings: () => {},
});

export const ListBillingProvider = ({ children }: { children: ReactNode }) => {
  const [billings, setBillings] = useState<Billing[]>([]);

  const addCreatedBillingToList: IBillingContext["addCreatedBillingToList"] = (
    billing: Billing,
  ) => {
    return setBillings((prev) => [billing, ...prev ]);
  };

  const getBillings: IBillingContext["getBillings"] = async () => {

    const data = await fetchBillings().then(data => data)
    return setBillings(data);
  }

  return (
    <ListBillingContext.Provider
      value={{
        billings,
        addCreatedBillingToList,
        getBillings,
      }}
    >
      {children}
    </ListBillingContext.Provider>
  );
};