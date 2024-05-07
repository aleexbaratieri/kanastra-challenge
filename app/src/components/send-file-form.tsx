import { FormEventHandler, ReactElement, useContext, useState } from 'react';

import * as Ui from './ui';
import { Loader2 } from 'lucide-react';
import { createBillingDocument } from '@/services/api';
import { Billing, CreateBillingInput } from '@/services/types';
import { useToast } from './ui/use-toast';
import { ListBillingContext } from '@/contexts/billings';

const SendFileForm = (): ReactElement => {

  const [name, setName] = useState<string>("");
  const [description, setDescription] = useState<string>("");
  const [file, setFile] = useState<File>();
  const [isSubmitLoading, setIsSubmitLoading] = useState<boolean>(false);

  const { addCreatedBillingToList } = useContext(ListBillingContext);

  const { toast } = useToast();

  const handleNameChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setName(e.target.value);
  };

  const handleDescriptionChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    setDescription(e.target.value);
  };

  const handleOnChangeFile = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (!e.target.files) return;
    setFile(e.target.files[0]);
  }

  const handleSendDocumentSubmit: FormEventHandler<HTMLFormElement> = async (e) => {
    e.preventDefault();
    setIsSubmitLoading(true);
    const data: CreateBillingInput = {
      document: file,
      name,
      description,
    }

    await createBillingDocument(data)
      .then((data: Billing) => {
        toast({
          variant: "success",
          title: "Successo",
          description: "Documento enviado para processamento",
        })
        setIsSubmitLoading(false);
        setName("");
        setDescription("");
        setFile(undefined);
        addCreatedBillingToList(data)
      })
      .catch((err) => {
        toast({
          variant: "destructive",
          title: "Erro",
          description: err.response.data.message,
        })
        setIsSubmitLoading(false);
      });
  };

  return (
    <form className="pt-8" onSubmit={handleSendDocumentSubmit}>
      <Ui.Input
        placeholder="Identificador"
        className="border-none text-zinc-800"
        onChange={handleNameChange}
        value={name}
      />

      <Ui.Textarea
        placeholder="Breve descrição"
        className="border-none mt-6 text-zinc-800"
        onChange={handleDescriptionChange}
        value={description}
      />

      <Ui.FileUploader
        file={file}
        onChange={handleOnChangeFile}
      />

      <Ui.Button
        className="mt-6 w-full bg-orange-500 text-white hover:bg-orange-400"
        type="submit"
        disabled={isSubmitLoading}
      >
        {isSubmitLoading && (
          <Loader2 className="mr-2 h-4 w-4 animate-spin" />
        )}
        Enviar arquivo
      </Ui.Button>
    </form>
  );
};

export { SendFileForm };
