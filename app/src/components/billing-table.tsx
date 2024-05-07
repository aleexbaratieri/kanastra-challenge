/* eslint-disable react-hooks/exhaustive-deps */
import { ReactElement, useContext, useEffect } from "react"

import * as Ui from './ui';
import format from "date-fns/format";
import { ListBillingContext } from "@/contexts/billings";

const BillingTable = (): ReactElement => {

  const { billings, getBillings } = useContext(ListBillingContext);

  useEffect(() => {
    getBillings();
  }, []);

  return (
    <div>
      <Ui.Table className="mt-6">
        <Ui.TableCaption>List de envios recentes.</Ui.TableCaption>
        <Ui.TableHeader>
          <Ui.TableRow className="text-white">
            <Ui.TableHead>Identificador</Ui.TableHead>
            <Ui.TableHead className="w-[50%]">Descrição</Ui.TableHead>
            <Ui.TableHead>Status</Ui.TableHead>
            <Ui.TableHead className="text-right">Data de envio</Ui.TableHead>
          </Ui.TableRow>
        </Ui.TableHeader>
        <Ui.TableBody>
          {billings.map((billing) => (
            <Ui.TableRow key={billing.id}>
              <Ui.TableCell className="font-medium">{billing.name}</Ui.TableCell>
              <Ui.TableCell>{billing.description}</Ui.TableCell>
              <Ui.TableCell>{billing.status}</Ui.TableCell>
              <Ui.TableCell className="text-right">{format(new Date(billing.updated_at), 'dd/MM/yyyy HH:mm:ss')}</Ui.TableCell>
            </Ui.TableRow>
          ))}
        </Ui.TableBody>
      </Ui.Table>
    </div>
  );
};

export { BillingTable }