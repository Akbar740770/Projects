import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'truncate',
  standalone: true
})
export class TruncatePipe implements PipeTransform {

  transform(title: string, limit: number = 20 ): string {
    if (!title) return ''; 
    return title.length > limit ? title.substring(0, limit) + '...' : title;
    }
  }


