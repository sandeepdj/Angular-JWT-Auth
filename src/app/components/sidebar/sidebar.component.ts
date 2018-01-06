import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AppGlobals } from '../../shared/app.global';

import { SidebarService } from './../../services/index';



@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.css']
})
export class SidebarComponent implements OnInit {
    _postsArray:any[];

  constructor(private http: HttpClient, private _global: AppGlobals,private SService:SidebarService) { }

  ngOnInit() {
  	this.getSidebar();
  }

 getSidebar() {
       this.SService.modulesList()
       .subscribe(
        resultArray => this._postsArray = resultArray,
        error => console.log("Error :: " + error)
    )

	// .subscribe(menuList => {
    // this.menuListData = menuList.data;
    //     console.log(menuList);
    // });
}
  


}
