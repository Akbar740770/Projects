import { Pipe, PipeTransform } from "@angular/core";

@Pipe({
    name: 'UpperCasePipe',
    standalone: true,
    pure: true,

})
export class customUpperCasePipe implements PipeTransform{
    transform(text: string) {
        return text.toUpperCase()
    }
 
}