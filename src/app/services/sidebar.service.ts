import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map'

import { AppGlobals } from '../shared/app.global';


@Injectable()
export class SidebarService {

  constructor(private http:HttpClient,private _global: AppGlobals) { }
	modulesList(){
    return this.http.get( this._global.baseAPIUrl+'modules')
        .map((data: any) => {
          return data.data;
        })	
    }

  public getToken(): string {
     return localStorage.getItem('token');
  }



}
