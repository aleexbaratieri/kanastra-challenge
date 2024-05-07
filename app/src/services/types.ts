export type Billing = {
  id: string;
  name: string;
  description: string;
  storage_document_path: string;
  status: string;
  created_at: string;
  updated_at: string;
};

export type CreateBillingInput = {
  name: string;
  description: string;
  document: File | undefined;
};
