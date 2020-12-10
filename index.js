const express = require('express');
const { port } = require('./config');

const app = express();

app.get('/', (req, res) => res.send('Express server is up and running!'));

app.listen(port, (err) => {
  if (err) {
    console.error(err);
  } else {
    console.log(`Express server listening on ${port}`);
  }
});
