// Set Grid Column
gantt.config.columns = [
    {name:"J_K",       label:"Jenis Kegiatan", tree:true},
    {name:"neraca",       label:"Neraca",align:"center"},
    {name:"kegiatan",       label:"Kegiatan",align:"center"},
    {name:"T_S",       label:"TSample",align:"center"},
    {name:"keterangan",       label:"Keterangan",align:"center"},
    {name:"add",        label:"", }
];
// get week
function getWeekOfMonthNumber(date){
    let adjustedDate = date.getDate()+date.getDay();
    let prefixes = ['0', '1', '2', '3', '4', '5'];
    return (parseInt(prefixes[0 | adjustedDate / 7])+1);
} 
// several scales at once
gantt.config.scales = [
    {unit: "month", step: 1, format: "%F, %Y"},
    {unit: "week", step: 1, format: function(date){
        return "Week #" + getWeekOfMonthNumber(date);
     }},
];
// ✅ Get the first and last day of the current year
const currentYear = new Date().getFullYear();
console.log(currentYear); // 👉️ 2023

const firstDay = new Date(currentYear, 0, 1);
console.log(firstDay); // 👉️ Sun Jan 01 2023

const lastDay = new Date(currentYear, 11, 31);
console.log(lastDay); // 👉️ Sun Dec 31 2022


gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
gantt.load("api/dataProduksi");
gantt.init("gantt_here");
// ============================================================================

let gc = gantt.config;
let gl = gantt.layout;
let gt = gantt.templates;
// Set Grid Column ====================================================================
gc.columns = [
    {name:"J_K",       label:"Jenis Kegiatan", width:"*", align:"start", tree:true},
    {name:"neraca",       label:"Neraca",align:"center"},
    {name:"kegiatan",       label:"Kegiatan",align:"center"},
    {name:"T_S",       label:"TSample", width:30,align:"center"},
    {name:"keterangan",       label:"Keterangan",align:"center"},
];
gc.min_grid_column_width = 30;
gc.grid_width = 400;
// gc.autofit = true;
gt.grid_row_class = function(start, end, task){
    return "styleGridRow";
};
// =================================================================
// get week
// function getWeekOfMonthNumber(date){
//     let adjustedDate = date.getDate()+date.getDay();
//     let prefixes = ['0', '1', '2', '3', '4', '5'];
//     return (parseInt(prefixes[0 | adjustedDate / 7])+1);
// } 
// // several scales at once
// gc.scales = [
//     {unit: "month", step: 1, format: "%Y, %F"},
//     // {unit: "month", step: 1, format: "%F"},
//     // {unit: "day", step: 1, format: "%j"}
//     // {unit: "week", step: 1, format: function(date){
//     //     return "Week #"+getWeekOfMonthNumber(date);
//     // }},
// ];
// // ✅ Get the first and last day of the current year
// const currentYear = new Date().getFullYear();
// // console.log(currentYear); // 👉️ 2023

// const firstDay = new Date(currentYear, 0, 1);
// // console.log(firstDay); // 👉️ Sun Jan 01 2023

// const lastDay = new Date(currentYear, 11, 31);
// // console.log(lastDay); // 👉️ Sun Dec 31 2022

// gantt.config.start_date = firstDay;
// gantt.config.end_date = lastDay;

// gc.date_format = "%Y-%m-%d %H:%i:%s";
// gantt.init("gantt_here");
// gantt.load("api/dataProduksi");

// fetch('api/dataProduksi').then(response => response.json()).then(json => console.log(JSON.parse(JSON.stringify(json))));
