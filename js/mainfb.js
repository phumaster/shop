
// lướt từ trái sang TweenMax.to(target,duration,{vars});
	// TweenMax.to("#logo",2,{left:550,
	// 	backgroundColor:"red",
	// 	padding:20,
	// 	borderColor:"green",
	// 	borderRadius:26
	// });
 // ----------------End-------------------











//   TweenMax.staggerFrom("#img1",2,{backgroundColor:"red",
//  	opacity:0,
//  	// marginTop:100,
//  	rotation:90, //xoay 360 do
//  	scale:3 //phong to gap 6
 	
//  });

//   TweenMax.staggerFrom(".list-motto",0.5,{opacity:0,

  	
//   	rotation:180,
//   	scale:0
//   },0.3);
// TweenMax.fromTo(elem, 4, {fromVars}, {toVars})()


// phóng to và xoay chiều
 // TweenMax.to("#logo",6,{backgroundColor:"red",
 // 	x:600,
 // 	// marginTop:100,
 // 	rotation:90, //xoay 360 do
 // 	scale:1 //phong to gap 6
 	
 // });
 // ----------------End-------------------

















// di chuyển nhiều hình ảnh
 // ****TweenMax.to("#logo", 6,{x:600,****
 // 	backgroundColor:"red",
 // 	rotation:90,
 // 	ease:Back.easeOut //ảnh chạy qua và lùi lại vào vị trí x
 // 	ease:Elastic.easeOut //ảnh chạy qua nhanh hơn so vs Back
 // 	ease:Bounce.easeOut //ảnh đập đi đập lại bounce(nhún nhảy-vaddaapj)
 // });
 // ----------------End-------------------



// *****TweenLite.from đi từ phải sang (ngược lại so vs TweenLite.to)*****
	// TweenLite.to("#logo",6,{x:600, ease:Bounce.easeInOut,
	// backgroundColor:"red",
	// rotation:360});
 // ----------------End-------------------



// hiện ra hình ảnh ngay tại vị trí của nó (x:0 - y:0 - kiểu nhấp nháy)
  // TweenMax.from("#logo",3,{opacity:0,
  // 	scale:0,
  // 	ease:Bounce.easeOut});


// hiện ra từng class box một liên tiếp nhau trong 5 cái
 // TweenMax.staggerFrom(".box",0.5,{opacity:0,
 // 	y:200,
 // 	//delay:2,
 // 	rotation:360,
 // 	scale:10
 // },0.2);


//tạo alert
	// TweenMax.to("#logo,.box", 7,{opacity:0,delay:0.5,onComplete:cccomplete});

	// function cccomplete(){
	// 	alert("well done :)~")

	// }

