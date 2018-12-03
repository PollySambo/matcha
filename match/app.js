const express = require('express');
const mysql = require('mysql');

//create connection
let db = mysql.createConnection({
    user        :'root',
    host        :'localhost',
    password    :'polite',
    database    :'matcha'
});

//connect
db.connect((err) => {
    if(err){
        console.log(err.toString());
        db.end();
      }else{
        console.log('Connection established');
    }
});

const app = express();

// create DB
app.get('/createdb', (req, res) =>{
    let sql = 'CREATE DATABASE matcha';
    db.query(sql, (err, result) =>{
        if(err) {
            res.status(500).send(err.toString());
        }else{
        res.send('Database created');
        }
    });
});


// create table
app.get('/table', (req, res) =>{
    let sql = 'CREATE TABLE IF NOT EXISTS users(id  int AUTO_INCREMENT, name VARCHAR(255), surname VARCHAR(255) , email VARCHAR(255), Password VARCHAR(255), PRIMARY KEY(id) )';
    db.query(sql, (err, result) => {
        if(err) {
            res.status(500).send(err.toString());
        }else{
            res.send('Users table created');
        }
    });
});

app.listen(3000, () => {
    console.log(`Server started on port 3000`);
});