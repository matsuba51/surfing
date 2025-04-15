// スクロールして一定の高さに達したらトップボタンを表示
window.onscroll = function () {
  const topButton = document.getElementById("topButton");
  if (topButton) {  // topButtonがnullでないことを確認
    if (document.documentElement.scrollTop > 300) {
      topButton.style.display = "block";
    } else {
      topButton.style.display = "none";
    }
  }
};

// トップに戻る関数
window.scrollToTop = function () {
  window.scrollTo({ top: 0, behavior: 'smooth' });
};
