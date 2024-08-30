export default class BaseStore<T> {
    private baseUrl: string;
  
    constructor(baseUrl: string) {
      this.baseUrl = baseUrl;
    }
  
    async get(): Promise<T[]> {
      try {
        const response = await fetch(`${this.baseUrl}`);
        if (!response.ok) {
          throw new Error(`Failed to fetch items: ${response.statusText}`);
        }
        return await response.json();
      } catch (error) {
        console.error(error);
        throw error;
      }
    }
  
    async getById(id: string | number): Promise<T> {
      try {
        const response = await fetch(`${this.baseUrl}/${id}`);
        if (!response.ok) {
          throw new Error(`Failed to fetch item with ID ${id}: ${response.statusText}`);
        }
        return await response.json();
      } catch (error) {
        console.error(error);
        throw error;
      }
    }

    async post(data: T): Promise<T> {
      try {
        const response = await fetch(`${this.baseUrl}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept':'application/json'
          },
          body: JSON.stringify(data),
        });
        if (!response.ok) {
          throw new Error(`Failed to create item: ${response.statusText}`);
        }
        return await response.json();
      } catch (error) {
        console.error(error);
        throw error;
      }
    }
  
    async put(id: string | number, data: Partial<T>): Promise<T> {
      try {
        const response = await fetch(`${this.baseUrl}/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Accept':'application/json'
          },
          body: JSON.stringify(data),
        });
        if (!response.ok) {
          throw new Error(`Failed to update item with ID ${id}: ${response.statusText}`);
        }
        return await response.json();
      } catch (error) {
        console.error(error);
        throw error;
      }
    }
  }