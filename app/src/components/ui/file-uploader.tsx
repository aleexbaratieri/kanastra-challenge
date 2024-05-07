import React from "react";

type FileUploaderProps = {
  file: File | undefined;
  onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
}

const FileUploader = ({file, onChange }: FileUploaderProps) => {

  return (
    <div className = "flex flex-col gap-6 border-none mt-6">
      <div>
        <input 
          className="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" 
          id="small_size" 
          type="file" 
          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv" 
          onChange={onChange}
        />
      </div>
      {file && (
        <section>
          <p className="pb-6">Detalhes de arquivo:</p>
          <ul>
            <li>Name: {file.name}</li>
            <li>Type: {file.type}</li>
            <li>Size: {file.size} bytes</li>
          </ul>
        </section>
      )}
    </div>
  );
};

export { FileUploader };
