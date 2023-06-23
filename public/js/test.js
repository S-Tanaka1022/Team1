var tabs = document.querySelectorAll('#tabcontrol a');
var pages = document.querySelectorAll('#tabbody div');
var currentTab = 'tabpage1'; // 初期値として1つ目のタブを指定

function showTab(targetid) {
  // 指定のタブページだけを表示する
  for (var i = 0; i < pages.length; i++) {
    if (pages[i].id != targetid) {
      pages[i].style.display = "none";
    } else {
      pages[i].style.display = "block";
    }
  }

  // クリックされたタブを前面に表示する
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].style.zIndex = "0";
  }

  var selectedTab = document.querySelector('#tabcontrol a[href="#' + targetid + '"]');
  selectedTab.style.zIndex = "10";

  currentTab = targetid; // 現在のタブを更新
}

// タブをクリックしたときの処理
for (var i = 0; i < tabs.length; i++) {
  tabs[i].addEventListener('click', function (event) {
    var targetid = this.getAttribute('href').substring(1); // クリックされたタブのidを取得
    showTab(targetid); // タブを切り替える
  });
}

// 検索ボタンを押したときの処理
var searchForm = document.querySelector('form[action=""]');
searchForm.addEventListener('submit', function (event) {
  // 現在のタブを保持しておく
  var activeTab = document.querySelector('#tabcontrol a[z-index="10"]');
  if (activeTab) {
    currentTab = activeTab.getAttribute('href').substring(1);
  }
});

// ページ読み込み時に初期値のタブを表示する
window.addEventListener('load', function () {
  var targetid = window.location.hash.substring(1); // URLのハッシュからタブのidを取得
  if (targetid) {
    showTab(targetid); // タブを表示する
  } else {
    showTab(currentTab); // 初期値のタブを表示する
  }
});
