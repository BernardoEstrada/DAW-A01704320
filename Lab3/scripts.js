
//This
function timesTwo(params) {
  return params * 2
}
console.log(timesTwo(4));  // 8

//is the same as this
let tt = (params) => {
  return params * 2;
}
console.log(tt(4));  // 8

//and This
let tt2 = params => params * 2;
console.log(tt2(4));  // 8

///-----------------
///-----------------
///-----------------

//This
let feedTheCat1 = (cat) => {
  if (cat === 'hungry') {
    return 'Feed the cat';
  } else {
    return 'Do not feed the cat';
  }
}
console.log(feedTheCat1('hungry'));
console.log(feedTheCat1(''));

//Is also the same as this
let feedTheCat2 = (cat) => cat==='hungry'?'Feed the cat':'Do not Feed the cat';
console.log(feedTheCat2('hungry'));
console.log(feedTheCat2(''));
