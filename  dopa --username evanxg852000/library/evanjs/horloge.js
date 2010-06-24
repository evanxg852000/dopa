function horloge(){
dt=new Date();
hrs=dt.getHours();
min=dt.getMinutes();
sec=dt.getSeconds();
temps=hrs+" H : "+min+" mn : "+sec+" s";
document.horloge.watch.value=temps;
setTimeout("horloge()",1000);
}