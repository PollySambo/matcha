var MongoClient = require('mongodb').MongoClient;
//Create a database named "matcha":
var url = "mongodb://localhost:8080/matcha";

MongoClient.connect(url, function(err, db) {
  if (err) throw err;
  console.log("Database created!");
  db.close();
});