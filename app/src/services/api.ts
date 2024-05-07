import axios, { AxiosInstance } from 'axios';

import { Billing, CreateBillingInput } from './types';

const http: AxiosInstance = axios.create({
  baseURL: `http://localhost:8000/api/`,
  headers: {
    'Content-Type': 'application/json'
  }
});

const fetchBillings = async (): Promise<Billing[]> => {
  return await http.get('billings').then((response) => response.data);
};

const createBillingDocument = async (
  data: CreateBillingInput
): Promise<Billing> => {
  const formData: FormData = new FormData();

  if (data.name) {
    formData.append('name', data.name);
  }

  if (data.description) {
    formData.append('description', data.description);
  }

  if (data.document) {
    formData.append('document', data.document as Blob);
  }

  return await http
    .post('billings/proccess-document', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then((response) => response.data);
};

export { fetchBillings, createBillingDocument };
