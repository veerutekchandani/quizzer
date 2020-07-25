function myfunction(clicked) {
  clicked +="_desc";
  $("#"+clicked).slideToggle("slow");
}