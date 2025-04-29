import { Form, Input, InputNumber, DatePicker, Select, Button } from 'antd';
import { useEffect, useState } from 'react';
//import axios from 'axios';

const { Option } = Select;

const TransactionForm = ({ onSubmit }) => {
  const [form] = Form.useForm();
  const [comptes, setComptes] = useState([]);
  const [categories, setCategories] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      const [comptesRes, categoriesRes] = await Promise.all([
       // axios.get('/api/v1/comptes', {
         // headers: { Authorization: `Bearer ${localStorage.getItem('auth_token')}` }
        //}),
        //axios.get('/api/v1/categories', {
        //  headers: { Authorization: `Bearer ${localStorage.getItem('auth_token')}` }
       // })
      ]);
      setComptes(comptesRes.data.data);
      setCategories(categoriesRes.data.data);
    };

    fetchData();
  }, []);

  return (
    <Form form={form} layout="vertical" onFinish={onSubmit}>
      <Form.Item
        name="compte_id"
        label="Compte"
        rules={[{ required: true, message: 'Sélectionnez un compte' }]}
      >
        <Select placeholder="Sélectionnez un compte">
          {comptes.map(compte => (
            <Option key={compte.id} value={compte.id}>
              {compte.nom} ({compte.numero_compte})
            </Option>
          ))}
        </Select>
      </Form.Item>

      <Form.Item
        name="categorie_id"
        label="Catégorie"
        rules={[{ required: true, message: 'Sélectionnez une catégorie' }]}
      >
        <Select placeholder="Sélectionnez une catégorie">
          {categories.map(categorie => (
            <Option key={categorie.id} value={categorie.id}>
              {categorie.nom}
            </Option>
          ))}
        </Select>
      </Form.Item>

      <Form.Item
        name="montant"
        label="Montant"
        rules={[{ required: true, message: 'Entrez un montant' }]}
      >
        <InputNumber
          style={{ width: '100%' }}
          min={0.01}
          step={0.01}
          formatter={value => `${value} €`}
          parser={value => value.replace(' €', '')}
        />
      </Form.Item>

      <Form.Item
        name="date_operation"
        label="Date"
        rules={[{ required: true, message: 'Sélectionnez une date' }]}
      >
        <DatePicker style={{ width: '100%' }} />
      </Form.Item>

      <Form.Item
        name="description"
        label="Description"
        rules={[{ required: true, message: 'Entrez une description' }]}
      >
        <Input.TextArea rows={3} />
      </Form.Item>

      <Form.Item>
        <Button type="primary" htmlType="submit">
          Enregistrer
        </Button>
      </Form.Item>
    </Form>
  );
};

export default TransactionForm;