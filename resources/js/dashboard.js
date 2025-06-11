axios.get('/tasks?status=1').then(res => {
  console.log(res.data);
});