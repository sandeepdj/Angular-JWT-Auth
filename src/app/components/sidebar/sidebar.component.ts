import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AppGlobals } from '../../shared/app.global';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.css']
})


export class SidebarComponent implements OnInit {

  constructor(private http: HttpClient, private _global: AppGlobals) { }

  ngOnInit() {
  	this.getSidebar();
  }

 getSidebar() {
  	this.http.get(this._global.baseAPIUrl+'modules')
	.subscribe(data => {
      console.log(data);
    });
   

}
  


}
