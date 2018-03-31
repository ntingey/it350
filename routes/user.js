let md5 = require('md5');

exports.signup = function(req, res){
   message = '';
   if(req.method == "POST"){
      //post data

   } else {
      res.render('signup');
   }
};

exports.login = function(req, res){
   var message = '';
   var sess = req.session; 

   if(req.method == "POST"){
      var post  = req.body;
      var name= post.user_name;
      var pass= md5(post.password);
     
      var sql="SELECT user_email FROM `users` WHERE `user_email`='"+name+"' and password = '"+pass+"'";                           
      db.query(sql, function(err, results){      
         if(results.length){
            req.session.userId = results[0].id;
            req.session.user = results[0];
            console.log(results[0].id);
            res.redirect('/products');
         }
         else{
            message = 'Wrong Credentials.';
            res.render('index.ejs',{message: message});
         }
                 
      });
   } else {
      res.render('index.ejs',{message: message});
   }         
};
exports.products = function(req, res){

  req.getConnection(function(err,connection){   
      var query = connection.query('SELECT * FROM products',function(err,rows){
        if(err) console.log("Error Selecting : %s ",err );
        	var query2 = connection.query('SELECT product_id FROM products', function(err,result){
  				if(err) console.log("Error Selecting : %s ",err );
  				console.log(result);
           
              
  				res.render('products',{page_title:"products",data:rows, dropdownVals: result});
          

  			});
        
      });
  });

 // req.getConnection(function(err,connection){
      
//});
};

exports.blog_comment = function (req, res){

 if(req.method == "POST"){
  var post  = req.body;
  var comment = post.comment;
  var message = '';

dbmongo.collection('Article', function(err, collection){
    collection.insert({comments: comment});

    dbmongo.collection('Article').count(function (err,count){
      if(err) throw err;
      console.log('Total Rows: '+ count);
      res.redirect('/blog');
    });
  });
}
};


exports.number_of_hats = function(req, res){

  req.getConnection(function(err,connection){   
       var query3 = connection.query('SELECT * FROM num_hats', function(err, num){
            if(err) console.log("Error Selecting : %s ",err );
            console.log(num);
           
              
          res.render('number_of_hats',{page_title:"hats",numhats:num});
          

        });
        
  });

 // req.getConnection(function(err,connection){
      
//});
};

// exports.blog = (function(req, res){

//   var mongoose = require('mongodb');
//   mongoose.connect('mongodb://localhost/Article');

// var Article = "";
//   req.getConnection(function(err,connection){   
//        Article.find({}, function(err, docs){
//     if(err) res.json(err);
//     else    res.render('blog', {Article: docs});
//        });

//   });

// };

exports.order = function(req, res, next){
	
	// var user =  req.session.user,
	// userId = req.session.userId;
	 var message;

      var post  = req.body;
      var user_email= post.user_email;
      var product_id = post.product_id
      console.log(req.body);

      
      if(!user_email || !product_id ){
      	message = "Missing information on form";
      	res.send(req.body);
      }
      else {
      	console.log(post);
      var sql = "INSERT INTO orders(user_email, product_id) VALUES ('" + user_email + "','" + product_id + "')";
	   	db.query(sql, function(err, results){
		   console.log("res", results);	 
		   		res.render('success.ejs');
 		  
		});
	   }
};


// router.get('/', function(req, res, next) {
//     sql.connect(config).then(() => {
//         return sql.query`select product_id from products`
//     }).then(result => {
//         console.log(result)
//         // Pass the DB result to the template
//         res.render('newProject', {dropdownVals: result})
//     }).catch(err => {
//         console.log(err)
//     })
// });