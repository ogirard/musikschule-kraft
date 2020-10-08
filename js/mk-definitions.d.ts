/// <reference path="../bower_components/DefinitelyTyped/jquery/jquery.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular-route.d.ts" />

declare module MusikschuleKraft {
  interface IMainScope extends ng.IScope {
    angebot : any;
    news : any;
    slug : string;
    titlePostfix : string;

    notNullOrEmpty(text:string) : boolean;
  }

  interface IContactMailScope extends ng.IScope {
    message : any;
    submitted : boolean;
    error : boolean;
    mailsent : boolean;

    cancel() : void;
    reset() : void;
    sendContactMail(isFormValid:boolean) : void;
  }
}