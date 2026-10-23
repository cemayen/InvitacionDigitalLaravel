<footer class="fixed bottom-0 w-full pb-5 z-20">
    <div class="sm:max-w-125 w-[90%] mx-auto bgFoto border-2 border-gris-100 px-2 py-1.5 rounded-[50px] shadow-sm shadow-marfil-1">
        <div class="grid grid-cols-4 sm:gap-4 gap-2 items-center">
            
            <a href="{{ route('inicio.index') }}" class=" xs:w-12.5 w-10 action">
                <img src="{{ asset('assets/imgs/jc.svg') }}" class="w-full" alt="">
            </a>
            <a href="{{ route('inicio.invitacion') }}" class="flex flex-col gap-1 w-fit action mx-auto text-gris-500 hover:text-arena transicion">
                <svg class="xs:size-6.5 size-5 mx-auto fill-current" viewBox="0 0 640 640">
                    <path d="M576 160C576 210.2 516.9 285.1 491.4 315C487.6 319.4 482 321.1 476.9 320L384 320C366.3 320 352 334.3 352 352C352 369.7 366.3 384 384 384L480 384C533 384 576 427 576 480C576 533 533 576 480 576L203.6 576C212.3 566.1 222.9 553.4 233.6 539.2C239.9 530.8 246.4 521.6 252.6 512L480 512C497.7 512 512 497.7 512 480C512 462.3 497.7 448 480 448L384 448C331 448 288 405 288 352C288 299 331 256 384 256L423.8 256C402.8 224.5 384 188.3 384 160C384 107 427 64 480 64C533 64 576 107 576 160zM181.1 553.1C177.3 557.4 173.9 561.2 171 564.4L169.2 566.4L169 566.2C163 570.8 154.4 570.2 149 564.4C123.8 537 64 466.5 64 416C64 363 107 320 160 320C213 320 256 363 256 416C256 446 234.9 483 212.5 513.9C201.8 528.6 190.8 541.9 181.7 552.4L181.1 553.1zM192 416C192 398.3 177.7 384 160 384C142.3 384 128 398.3 128 416C128 433.7 142.3 448 160 448C177.7 448 192 433.7 192 416zM480 192C497.7 192 512 177.7 512 160C512 142.3 497.7 128 480 128C462.3 128 448 142.3 448 160C448 177.7 462.3 192 480 192z"/>
                </svg>
                <p class="text-center text-xs font-medium">Invitacion</p>
            </a>
            <div>
                @auth
                    @if (Auth::user()->rol === 'Admin')
                        <a href="{{ route('dashboard.index') }}" class="flex flex-col gap-1 w-fit action mx-auto text-gris-500 hover:text-arena transicion">
                            <svg class="xs:size-6.5 size-5 mx-auto fill-current" viewBox="0 0 640 640">
                                <path d="M96 128C60.7 128 32 156.7 32 192L32 256C32 264.8 39.4 271.7 47.7 274.6C66.5 281.1 80 299 80 320C80 341 66.5 358.9 47.7 365.4C39.4 368.3 32 375.2 32 384L32 448C32 483.3 60.7 512 96 512L544 512C579.3 512 608 483.3 608 448L608 384C608 375.2 600.6 368.3 592.3 365.4C573.5 358.9 560 341 560 320C560 299 573.5 281.1 592.3 274.6C600.6 271.7 608 264.8 608 256L608 192C608 156.7 579.3 128 544 128L96 128zM448 400L448 240L192 240L192 400L448 400zM144 224C144 206.3 158.3 192 176 192L464 192C481.7 192 496 206.3 496 224L496 416C496 433.7 481.7 448 464 448L176 448C158.3 448 144 433.7 144 416L144 224z"/>
                            </svg>
                            <p class="text-center text-xs font-medium">Admin</p>
                        </a>
                    @else
                        <a href="{{ route('cuenta.index') }}" class="flex flex-col gap-1 w-fit action mx-auto text-gris-500 hover:text-arena transicion">
                            <svg class="xs:size-6.5 size-5 mx-auto fill-current" viewBox="0 0 640 640">
                                <path d="M96 128C60.7 128 32 156.7 32 192L32 256C32 264.8 39.4 271.7 47.7 274.6C66.5 281.1 80 299 80 320C80 341 66.5 358.9 47.7 365.4C39.4 368.3 32 375.2 32 384L32 448C32 483.3 60.7 512 96 512L544 512C579.3 512 608 483.3 608 448L608 384C608 375.2 600.6 368.3 592.3 365.4C573.5 358.9 560 341 560 320C560 299 573.5 281.1 592.3 274.6C600.6 271.7 608 264.8 608 256L608 192C608 156.7 579.3 128 544 128L96 128zM448 400L448 240L192 240L192 400L448 400zM144 224C144 206.3 158.3 192 176 192L464 192C481.7 192 496 206.3 496 224L496 416C496 433.7 481.7 448 464 448L176 448C158.3 448 144 433.7 144 416L144 224z"/>
                            </svg>
                            <p class="text-center text-xs font-medium">Registrar</p>
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="flex flex-col gap-1 w-fit mx-auto text-gris-500 hover:text-arena transicion">
                        <svg class="xs:size-6.5 size-5 mx-auto fill-current" viewBox="0 0 640 640">
                            <path d="M463 448.2C440.9 409.8 399.4 384 352 384L288 384C240.6 384 199.1 409.8 177 448.2C212.2 487.4 263.2 512 320 512C376.8 512 427.8 487.3 463 448.2zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320zM320 336C359.8 336 392 303.8 392 264C392 224.2 359.8 192 320 192C280.2 192 248 224.2 248 264C248 303.8 280.2 336 320 336z"/>
                        </svg>
                        <p class="text-center text-xs font-medium">Ingresar</p>
                    </a>
                @endauth
            </div>


            <div class="flex justify-center">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex flex-col gap-1 w-fit mx-auto action text-gris-500 hover:text-arena transicion">
                            <svg class="xs:size-6.5 size-5 mx-auto fill-current" viewBox="0 0 640 640">
                                <path d="M224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160zM566.6 342.6C579.1 330.1 579.1 309.8 566.6 297.3L438.6 169.3C426.1 156.8 405.8 156.8 393.3 169.3C380.8 181.8 380.8 202.1 393.3 214.6L466.7 288L256 288C238.3 288 224 302.3 224 320C224 337.7 238.3 352 256 352L466.7 352L393.3 425.4C380.8 437.9 380.8 458.2 393.3 470.7C405.8 483.2 426.1 483.2 438.6 470.7L566.6 342.7z"/>
                            </svg>
                            <p class="text-center text-xs font-medium">Salir</p>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex flex-col gap-1 w-fit mx-auto text-gris-500 hover:text-arena transicion">
                        <svg class="xs:size-6.5 size-5 mx-auto fill-current" viewBox="0 0 640 640">
                            <path d="M224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160zM566.6 342.6C579.1 330.1 579.1 309.8 566.6 297.3L438.6 169.3C426.1 156.8 405.8 156.8 393.3 169.3C380.8 181.8 380.8 202.1 393.3 214.6L466.7 288L256 288C238.3 288 224 302.3 224 320C224 337.7 238.3 352 256 352L466.7 352L393.3 425.4C380.8 437.9 380.8 458.2 393.3 470.7C405.8 483.2 426.1 483.2 438.6 470.7L566.6 342.7z"/>
                        </svg>
                        <p class="text-center text-xs font-medium">Ingresar</p>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</footer>
