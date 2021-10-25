$(document).ready(function () {
  let list = $("#carousel").children();
  let lenList = list.length;
  let pos = 0;

  $("#prev").click(() => {
    let curPos = pos;
    pos = (pos - 1 + lenList) % lenList;
    handleSlide(curPos, pos);
  });

  $("#next").click(() => {
    let curPos = pos;
    pos = (pos + 1) % lenList;
    handleSlide(curPos, pos);
  });

  function handleSlide(curPos, newPos) {
    $($(list[curPos])[0]).removeClass("active");
    $($(list[newPos])[0]).addClass("active");
  }
});
