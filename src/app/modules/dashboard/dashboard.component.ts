import { Component, OnInit } from '@angular/core';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  colorsList: object;
  constructor(public dialog: MatDialog) {

    this.colorsList = [
      {
        "isbn": "9781593275846",
        "title": "Eloquent JavaScript, Second Edition",
        "author": "Marijn Haverbeke"
      },
      {
        "isbn": "9781449331818",
        "title": "Learning JavaScript Design Patterns",
        "author": "Addy Osmani",
      },
      {
        "isbn": "9781449365035",
        "title": "Speaking JavaScript",
        "author": "Axel Rauschmayer"
      },
      {
        "isbn": "9781491950296",
        "title": "Programming JavaScript Applications",
        "author": "Eric Elliott"
      },
      {
        "isbn": "9781593277574",
        "title": "Understanding ECMAScript 6",
        "author": "Nicholas C. Zakas",
      },
      {
        "isbn": "9781491904244",
        "title": "You Don't Know JS",
        "author": "Kyle Simpson",
      },
      {
        "isbn": "9781449325862",
        "title": "Git Pocket Guide",
        "author": "Richard E. Silverman",
      },
      {
        "isbn": "9781449337711",
        "title": "Designing Evolvable Web APIs with ASP.NET",
         "author": "Glenn Block, et al.",
      }
    ];
   }

   openDialog(){
    let dialogRef = this.dialog.open(DialogOverviewExampleDialog, {
      width: '250px',
     
    });

    dialogRef.afterClosed().subscribe(result => {
      console.log('The dialog was closed');
      
    });
  };

 

  ngOnInit() {
  }

}

 

 
