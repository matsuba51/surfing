// スクロールして一定の高さに達したらトップボタンを表示
window.onscroll = function() {
  let topButton = document.getElementById("topButton");
  if (document.documentElement.scrollTop > 300) {
      topButton.style.display = "block";
  } else {
      topButton.style.display = "none";
  }
};

// トップに戻る関数
function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}