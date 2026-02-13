const API_URL = '../api/';

const apiClient = {
    get: async (endpoint) => {
        try {
            const response = await fetch(`${API_URL}${endpoint}`);
            return await response.json();
        } catch (error) { console.error('Error GET:', error); }
    },
    post: async (endpoint, data) => {
        try {
            const response = await fetch(`${API_URL}${endpoint}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            return await response.json();
        } catch (error) { console.error('Error POST:', error); }
    }
};