<div class="x_content">
  <div id="alerts"></div>
  <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
    <div class="btn-group">
      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
      <ul class="dropdown-menu">
      </ul>
    </div>

    <div class="btn-group">
      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a data-edit="fontSize 5">
            <p style="font-size:17px">Grande</p>
          </a>
        </li>
        <li>
          <a data-edit="fontSize 3">
            <p style="font-size:14px">Normal</p>
          </a>
        </li>
        <li>
          <a data-edit="fontSize 1">
            <p style="font-size:11px">Pequeña</p>
          </a>
        </li>
      </ul>
    </div>

    <div class="btn-group">
      <a class="btn" data-edit="bold" title="Negrita (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
      <a class="btn" data-edit="italic" title="Italica (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
      <a class="btn" data-edit="strikethrough" title="Marcar"><i class="fa fa-strikethrough"></i></a>
      <a class="btn" data-edit="underline" title="Subrayar (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
    </div>

    <div class="btn-group">
      <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
      <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
      <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
      <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
    </div>

    <div class="btn-group">
      <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
      <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
      <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
      <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
    </div>

    <div class="btn-group">
      <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
      <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
    </div>
  </div>

  <div id="editor-one" name="contenedor" class="editor-wrapper"></div>

  <textarea name="observacion" id="texto-receta" style="display:none;"></textarea>
</div>