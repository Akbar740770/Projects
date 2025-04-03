import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'data',
  standalone: true,
  pure: true,
})
export class DataPipe implements PipeTransform {
  
  today: number = Date.now();

  transform(value: number): string {

    const date = new Date(value);

    return date.toLocaleDateString('ru-RU', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: 'numeric',
      minute: 'numeric',
    });
  }
}
