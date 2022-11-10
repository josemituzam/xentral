// This file can be replaced during build by using the `fileReplacements` array.
// `ng build --prod` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.
const parsedUrl = new URL(window.location.href);
const baseUrl = parsedUrl.hostname
export const environment = {
  production: false,
  hmr: false,
  apiUrl: `http://${baseUrl}:8080/api/v1/admin` //Developer mode;
  //apiUrl: `https://api.ispxentral.com/api/v1/admin`  //Production mode;
};

/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/plugins/zone-error';  // Included with Angular CLI.
