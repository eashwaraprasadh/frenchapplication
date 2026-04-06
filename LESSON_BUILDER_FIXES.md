# Lesson Builder Fixes - October 18, 2025

## Issues Fixed

### 1. Missing `editBlock` and `deleteBlock` Functions
**Error:** `ReferenceError: Can't find variable: deleteBlock` and `ReferenceError: Can't find variable: editBlock`

**Root Cause:** The JavaScript functions for editing and deleting content blocks were not defined in the `edit.blade.php` file.

**Solution:** Added the following functions to `resources/views/admin/lessons/edit.blade.php`:
- `editBlock(blockId)` - Enables edit mode for a content block
- `deleteBlock(blockId)` - Deletes a content block with confirmation
- `saveBlockEdit(button)` - Saves edited block content
- `cancelBlockEdit(block)` - Cancels edit mode
- `createEditForm(type, data, blockId)` - Creates the edit form HTML for different block types

**Location:** Lines 1139-1350 in `resources/views/admin/lessons/edit.blade.php`

### 2. 403 Forbidden Error for Image Loading
**Error:** `Failed to load resource: the server responded with a status of 403 ()`

**Root Cause:** The storage symlink on Hostinger was pointing to the wrong location, creating a circular reference:
- Incorrect: `public/storage -> storage/app/public` (relative path causing loop)
- Correct: `public/storage -> ../storage/app/public` (proper relative path)

**Solution:** 
1. Removed the incorrect symlink: `rm public/storage`
2. Created the correct symlink: `ln -s ../storage/app/public public/storage`
3. Verified images are now accessible at `/storage/lesson-content/images/`

**Hostinger Location:** `/home/u841409365/domains/tslanguageschool.com/public_html/public/storage`

### 3. HTTP Method Mismatch
**Issue:** The JavaScript code was using `PATCH` method but routes expected `PUT`

**Solution:** Changed the HTTP method in `saveBlockEdit()` function from `PATCH` to `PUT` to match the route definition:
```javascript
fetch(`/admin/lessons/${lessonId}/content-blocks/${blockId}`, {
    method: 'PUT',  // Changed from PATCH
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({
        content: blockData
    })
})
```

## Files Modified

1. **resources/views/admin/lessons/edit.blade.php**
   - Added 5 new JavaScript functions (lines 1139-1350)
   - Fixed HTTP method from PATCH to PUT (line 1313)
   - Total lines: 1457 (increased from 1204)

## Routes Used

- `POST /admin/lessons/{lesson}/content-blocks` - Add new block
- `PUT /admin/lessons/{lesson}/content-blocks/{block}` - Update block
- `DELETE /admin/lessons/{lesson}/content-blocks/{block}` - Delete block
- `POST /admin/lessons/{lesson}/content-blocks/reorder` - Reorder blocks

## Testing Checklist

- [x] Storage symlink created and verified
- [x] Images accessible via `/storage/lesson-content/images/`
- [x] Edit button functionality implemented
- [x] Delete button functionality implemented
- [x] HTTP method corrected to PUT
- [x] File deployed to Hostinger

## Deployment Status

✅ **Local:** Updated in `/Users/eash/Downloads/Hostedfrench/resources/views/admin/lessons/edit.blade.php`
✅ **Hostinger:** Deployed via SCP to `u841409365@193.202.45.164:~/domains/tslanguageschool.com/public_html/resources/views/admin/lessons/edit.blade.php`

## Next Steps

1. Clear browser cache (Ctrl+Shift+Delete or Cmd+Shift+Delete)
2. Refresh the lesson builder page
3. Test edit functionality on a content block
4. Test delete functionality on a content block
5. Test image upload functionality

All issues should now be resolved!

