const api = {
  async get(url) {
    const token = localStorage.getItem('token');
    const res = await fetch('http://localhost:3000/api' + url, {
      headers: { 'Authorization': 'Bearer ' + token }
    });
    return await res.json();
  },
  async post(url, data) {
    const res = await fetch('http://localhost:3000/api' + url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        ...(localStorage.getItem('token') ? {
          'Authorization': 'Bearer ' + localStorage.getItem('token')
        } : {})
      },
      body: JSON.stringify(data)
    });
    return await res.json();
  }
};