import { Directive, HostListener, HostBinding } from '@angular/core';

@Directive({
  selector: '[HoverShadow]', // Директива будет применяться к элементам с атрибутом appHoverShadow
  standalone: true,
})
export class HoverShadowDirective {
  color = 'white';

  @HostBinding('style.boxShadow')
  get boxShadow() {
    return this.color;
  }

  @HostListener('mouseenter')
  onMouseEnter() {
    this.color = '0 4px 15px rgba(235, 12, 12, 0.3)';
  }

  @HostListener('mouseleave')
  onMouseLeave() {
    this.color = 'none';
  }
}
