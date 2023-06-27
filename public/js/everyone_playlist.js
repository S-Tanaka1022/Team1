var tabs = document.querySelectorAll('#tabcontrol a');
var pages = document.querySelectorAll('#tabbody > div');
console.dir(pages);


function changeTab() {
   // ▼href属性値から対象のid名を抜き出す
   var targetid = this.href.substring(this.href.indexOf('#')+1,this.href.length);


   // ▼指定のタブページだけを表示する
    for(var i=0; i<pages.length; i++) {
        if( pages[i].id != targetid ) {
            pages[i].style.display = "none";
        }
        else {
            pages[i].style.display = "block";
        }
    }


   // ▼クリックされたタブを前面に表示する
   for(var i=0; i<tabs.length; i++) {
      tabs[i].style.zIndex = "0";
   }
   this.style.zIndex = "10";

   // ▼ページ遷移しないようにfalseを返す
   return false;
}

// ▼すべてのタブに対して、クリック時にchangeTab関数が実行されるよう指定する
for(var i=0; i<tabs.length; i++) {
   tabs[i].onclick = changeTab;
}

/*
var lastSelectedTab = localStorage.getItem("selectedTab");
if (lastSelectedTab) {
   var tabToSelect = document.querySelector(`a[href="${lastSelectedTab}"]`);
   if (tabToSelect) {
      tabToSelect.onclick();
   }
}

// タブがクリックされたら選択を記憶
for(var i=0; i<tabs.length; i++) {
   tabs[i].onclick = function() {
      localStorage.setItem("selectedTab", this.href);
      changeTab.call(this);
   };
}
*/


// ▼最初は先頭のタブを選択
tabs[0].onclick();
//showTab('tabpage1');
